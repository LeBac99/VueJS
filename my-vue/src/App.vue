<template>
  <div id="app">
    <div class="container">
    <comp-header/>
    <comp-baner/>
    <router-view/>
    <comp-footer/>
    </div>
  </div>
</template>

<script>
import CompHeader from './components/layouts/CompHeader.vue';
import CompBaner from './components/layouts/CompBaner.vue';
import CompFooter from './components/layouts/CompFooter.vue';

export default {
  name: 'App',
  components: {
    CompHeader,
    CompBaner,
    CompFooter
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
*{
  padding: 0px;
  margin: 0px;
}
</style>
