<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,

  props: {
    labels: {
      type: Array,
      required: true,
    },
    datasets: {
      type: Array,
      required: true,
    },
    loading: {
      type: Boolean,
      required: true,
    },
  },

  watch: {
    loading () {
      this.renderChart({
        labels: this.labels,
        datasets: this.datasets,
      },
      {
        scales: {
          xAxes: [{
            // stacked: true
          }],
          yAxes: [{
            ticks: {
              min: 0,
              stepSize: 1
            }
          }]
        },
        responsive: true,
        maintainAspectRatio: false,
        onClick: this.handle
      });
    }
  },

  mounted () {
  },

  methods: {
    handle (point, event) {
      console.log(point)
      if (event.length) {
        this.$emit('receieveBarChartAction', event[0]._index);
      }
    }
  }
}
</script>

<style scoped>
#line-chart {
  /* height: 80vh !important */
}
</style>