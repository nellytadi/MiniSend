<template>
  <div id="app">
    <Navigation></Navigation>
    <advanced-search></advanced-search>
    <email-table></email-table>
  </div>
</template>

<script>
import EmailTable from "../components/EmailTable";
import AdvancedSearch from "../components/AdvancedSearch";
import Navigation from "../components/Navigation";

export default {
  name: "Home",
  components: {
    EmailTable,
    AdvancedSearch,
    Navigation
  }
}
</script>

<style scoped>

</style>