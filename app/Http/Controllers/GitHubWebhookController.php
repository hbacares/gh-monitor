<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Build;
use App\Models\EventLog;
use App\Models\Repository;

class GitHubWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = $request->header('X-GitHub-Event');
        $payload = $request->all();

        $signature = 'sha256=' . hash_hmac('sha256', $request->getContent(), env('GITHUB_WEBHOOK_SECRET'));
        if (!hash_equals($signature, $request->header('X-Hub-Signature-256'))) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // Store raw webhook data for auditing/debugging
        EventLog::create([
            'event_type' => $event,
            'payload' => $payload,
        ]);

        // Handle workflow_run event
        if ($event === 'workflow_run') {
            $workflow = $payload['workflow_run'] ?? null;
            $repository = $payload['repository'] ?? null;

            if ($workflow && $repository) {
                $repo = Repository::firstOrCreate(
                    ['github_id' => $repository['id']],
                    [
                        'name' => $repository['name'],
                        'full_name' => $repository['full_name'],
                        'url' => $repository['html_url'],
                        'user_id' => auth()->id() ?? 1, // fallback if unauthenticated
                    ]
                );

                Build::updateOrCreate(
                    ['run_id' => $workflow['id']],
                    [
                        'repository_id' => $repo->id,
                        'workflow_name' => $workflow['name'],
                        'status' => $workflow['status'],
                        'conclusion' => $workflow['conclusion'],
                        'started_at' => $workflow['run_started_at'],
                        'completed_at' => $workflow['updated_at'],
                    ]
                );
            }
        }

        return response()->json(['ok' => true]);
    }
}