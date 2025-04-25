<template>
  <div class="p-6 space-y-6">
    <h1 class="text-3xl font-bold">CI/CD Dashboard</h1>
    <p class="text-gray-600">Live status of your GitHub workflows.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-white rounded-xl shadow p-4">
        <h2 class="text-lg font-semibold">Recent Builds</h2>
        <ul>
          <li v-for="build in builds" :key="build.id" class="text-sm py-1">
            <strong>{{ build.workflow_name }}</strong>
            — {{ build.status }} ({{ build.conclusion ?? 'running' }})
          </li>
        </ul>
      </div>

      <div class="bg-white rounded-xl shadow p-4">
        <h2 class="text-lg font-semibold">Build Duration</h2>
        <canvas ref="chart"></canvas>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'
import axios from 'axios'

const builds = ref([])
const chart = ref(null)

onMounted(async () => {
  const res = await axios.get('/api/builds')
  builds.value = res.data

  const ctx = chart.value.getContext('2d')
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: builds.value.map(b => b.workflow_name),
      datasets: [{
        label: 'Build Duration (min)',
        data: builds.value.map(b => (
          (new Date(b.completed_at) - new Date(b.started_at)) / 60000
        )),
      }],
    },
  })
})
</script>