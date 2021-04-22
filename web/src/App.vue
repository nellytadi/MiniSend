<template>
  <div id="app">

      <Navigation></Navigation>
      <advanced-search></advanced-search>
  </div>
</template>

<script>

import Navigation from "./components/Navigation";
import AdvancedSearch from "./components/AdvancedSearch";
export default {
  name: 'App',
  components: {
    AdvancedSearch,
    Navigation

  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
