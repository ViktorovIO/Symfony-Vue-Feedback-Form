<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div id="navbarNav" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <router-link class="nav-item" tag="li" to="/" active-class="active">
            <a class="nav-link">Home</a>
          </router-link>
          <router-link class="nav-item" tag="li" to="/feedback" active-class="active">
            <a class="nav-link">Feedback</a>
          </router-link>
        </ul>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<script>
export default {
  name: "Index"
};
</script>