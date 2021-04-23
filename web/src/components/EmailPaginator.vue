<template>

  <pagination :data="items" @pagination-change-page="getResults"></pagination>

</template>

<script>
export default {
  name: "EmailPaginator",
  props: {
    items:Array,
    getResults:Array,
  }
}
</script>

<style scoped>

</style>