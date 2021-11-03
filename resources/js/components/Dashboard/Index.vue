<template>
  <div>
    <CategoryChart />

    <PeriodicalChart />
  </div>
</template>

<script>
import CategoryChart from "./CategoryChart/Index";
import PeriodicalChart from "./PeriodicalChart/Index";

export default {
  components: {
    CategoryChart,
    PeriodicalChart,
  }
};
</script>

<style>
</style>