<script>
import { Pie } from "vue-chartjs";

export default {
  extends: Pie,

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
    loading() {
      this.renderChart(
        {
          labels: this.labels,
          datasets: this.datasets,
        },
        {
          scales: {
            xAxes: [
              {
                // stacked: true
              },
            ],
            yAxes: [
              {
                ticks: {
                  min: 0,
                  stepSize: 1,
                },
              },
            ],
          },
          responsive: true,
          maintainAspectRatio: false,
        }
      );
    },
  },

  mounted() {},

  methods: {},
};
</script>

<style scoped>
#pie-chart {
  /* height: 80vh !important */
}
</style>