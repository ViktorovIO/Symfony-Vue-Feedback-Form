<template>
  <div>
    <p>Feedback List</p>
    <Feedback/>
  </div>
</template>
<script>
import Feedback from "./Feedback";

export default {
  name: "Home",
  components: { Feedback },
  template: "<Feedback/>",
}
</script>
<style scoped>

</style>