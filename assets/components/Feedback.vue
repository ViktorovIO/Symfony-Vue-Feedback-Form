<template>
  <div class="card w-100 mt-2">
    <div class="card-header">
      {{ id }} - {{ name }}
    </div>
    <div class="card-body">
      {{ phone }}
      <br>
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Feedback",
  props: {
    id: {
      type: Number,
      required: false
    },
    name: {
      type: String,
      required: true
    },
    phone: {
      type: String,
      required: true
    },
    message: {
      type: String,
      required: true
    }
  }
};
</script>