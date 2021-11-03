<template>
  <div class="row my-4">
    <div class="col-lg-12 px-2">
      <div class="card" fixedHeight>
        <div class="card-header">
          <div class="row">
            <div class="col">
              <p class="mb-0">{{ title }}</p>
              <small>Click on bar to view more</small>
            </div>
            <div class="col-auto">
              <div class="float-right">
                <button
                  class="btn btn-primary"
                  :disabled="periodicity == 'Year'"
                  @click="rollUpChart()"
                >
                  Roll Up
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <BarChart
            :labels="labels"
            :datasets="datasets"
            :loading="loading"
            @receieveBarChartAction="receieveBarChartAction"
          />
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
      periodicity: "Year",
      start: `${new Date().getFullYear()}-01-01`,
      end: `${new Date().getFullYear()}-12-31`,

      labels: [],
      datasets: [],
      loading: true,

      title: "Expenses Per Year",
    };
  },

  watch: {},

  mounted() {
    this.getPeriodicalChart();
  },

  methods: {
    rollUpChart() {
      if (this.periodicity == "Month") {
        this.periodicity = "Year";
        this.start = new Date();
        this.end = new Date();
        this.title = "Expenses Per Year";
        this.getPeriodicalChart();
      } else if (this.periodicity == "Day") {
        console.log(this.start);
        this.periodicity = "Month";
        this.start = `${new Date(this.start).getFullYear()}-01-01`;
        this.end = `${new Date(this.start).getFullYear()}-12-31`;
        this.title = `Expenses Per Month of Year ${new Date(
          this.start
        ).getFullYear()}`;
        this.getPeriodicalChart();
      }
    },

    receieveBarChartAction(action) {
      if (this.periodicity == "Year") {
        this.periodicity = "Month";
        this.start = `${this.labels[action]}-01-01`;
        this.end = `${this.labels[action]}-12-31`;
        this.title = `Expenses Per Month of Year ${this.labels[action]}`;
        this.getPeriodicalChart();
      } else if (this.periodicity == "Month") {
        this.periodicity = "Day";
        this.start = `${new Date(this.start).getFullYear()}-${action + 1}-01`;
        this.end = `${new Date(this.start).getFullYear()}-${action + 1}-31`;
        this.title = `Expenses Per Day of Month ${
          this.labels[action]
        } Year ${new Date(this.start).getFullYear()}`;
        this.getPeriodicalChart();
      }
    },

    getPeriodicalChart() {
      this.loading = true;

      if (this.periodicity == "Month") {
        this.labels = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        this.datasets = [];
      } else {
        this.labels = [];
        this.datasets = [];
      }

      this.axios
        .get(
          `/dashboard/get-periodical-chart-data?periodicity=${this.periodicity}&start=${this.start}&end=${this.end}`
        )
        .then((res) => {
          if (this.periodicity == "Year") {
            let years = res.data.data.map((element) => element.year);
            this.labels = [...new Set(years)];

            const expense_categories = res.data.data.map(
              (element) => element.display_name
            );

            [...new Set(expense_categories)].forEach((element) => {
              this.datasets.push({
                label: element,
                backgroundColor: `#${Math.floor(
                  Math.random() * 16777215
                ).toString(16)}80`,
                data: new Array(this.labels.length).fill(0),
              });
            });

            res.data.data.forEach((element) => {
              const dataset_index = this.datasets.findIndex(
                (dataset) => dataset.label === element.display_name
              );

              const label_index = this.labels.findIndex(
                (label) => label === element.year
              );
              this.datasets[dataset_index].data[label_index] =
                element.amount_total;
            });
          } else if (this.periodicity == "Month") {
            const expense_categories = res.data.data.map(
              (element) => element.display_name
            );

            [...new Set(expense_categories)].forEach((element) => {
              this.datasets.push({
                label: element,
                backgroundColor: `#${Math.floor(
                  Math.random() * 16777215
                ).toString(16)}80`,
                data: new Array(this.labels.length).fill(0),
              });
            });

            res.data.data.forEach((element) => {
              const dataset_index = this.datasets.findIndex(
                (dataset) => dataset.label === element.display_name
              );

              const label_index = this.labels.indexOf(
                this.labels[element.month - 1]
              );
              this.datasets[dataset_index].data[label_index] =
                element.amount_total;
            });
          } else if (this.periodicity == "Day") {
            let start = new Date(this.start);
            const end = new Date(this.end);
            while (start <= end) {
              let year = start.getFullYear();
              let month = start.getMonth() + 1;
              let date = start.getDate();
              if (month < 10) {
                month = "0" + month;
              }
              if (date < 10) {
                date = "0" + date;
              }
              this.labels.push(`${year}-${month}-${date}`);
              start.setDate(start.getDate() + 1);
            }

            const expense_categories = res.data.data.map(
              (element) => element.display_name
            );

            [...new Set(expense_categories)].forEach((element) => {
              this.datasets.push({
                label: element,
                type: "line",
                fill: false,
                borderColor: `#${Math.floor(Math.random() * 16777215).toString(
                  16
                )}80`,
                data: new Array(this.labels.length).fill(0),
              });
            });

            res.data.data.forEach((element) => {
              const dataset_index = this.datasets.findIndex(
                (dataset) => dataset.label === element.display_name
              );

              const label_index = this.labels.indexOf(element.date);
              this.datasets[dataset_index].data[label_index] =
                element.amount_total;
            });
          }

          this.loading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

