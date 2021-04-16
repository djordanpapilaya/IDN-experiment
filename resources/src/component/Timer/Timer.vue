<style src="./Timer.scss" module lang="scss"></style>
<script src="./Timer.js"></script>

<template>
  <div :class="[$style.timer]">
    <h3 :class="[$style.title, 'heading-03']">ELAPSED TIME / REMAINING TIME</h3>
    <p :class="['copy-01']">12:43:40 / 8:00:00</p>
  </div>
</template>
