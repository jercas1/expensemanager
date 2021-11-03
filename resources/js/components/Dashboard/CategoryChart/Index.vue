<template>
  <div class="row my-4">
    <div class="col-lg-12 px-2">
      <div class="card" fixedHeight>
        <div class="card-header">
          <div class="row">
            <div class="col">
              {{ title }}
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">Expense Categories</th>
                  <th class="text-right" scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(datum, index) in data"
                  :key="index"
                >
                  <td>{{ datum.display_name }}</td>
                  <td class="text-right">{{ datum.amount_total }}</td>
                </tr>
              </tbody>
            </table>
            </div>
            <div class="col-8">
              <BarChart
                :labels="labels"
                :datasets="datasets"
                :loading="loading"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BarChart from "./BarChart";

export default {
  components: {
    BarChart,
  },

  data() {
    return {
      data: [],

      labels: [],
      datasets: [
        {
          label: "Expense Categories",
          data: [],
          backgroundColor: [],
        },
      ],
      loading: true,

      title: "Expenses",
    };
  },

  watch: {},

  mounted() {
    this.getCategoryChart();
  },

  methods: {
    getCategoryChart() {
      this.loading = true;

      this.labels = [];
      this.datasets = [
        {
          label: "Expense Categories",
          data: [],
          backgroundColor: [],
        },
      ];

      this.axios
        .get("/dashboard/get-category-chart-data")
        .then((res) => {
          this.labels = [];
          this.datasets = [
            {
              label: "Expense Categories",
              data: [],
              backgroundColor: [],
            },
          ];

          res.data.data.forEach((element) => {
            this.labels.push(element.display_name);
            this.datasets[0].data.push(element.amount_total);
            this.datasets[0].backgroundColor.push(
              `#${Math.floor(Math.random() * 16777215).toString(16)}80`
            );
          });

          this.data = res.data.data;

          this.loading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

