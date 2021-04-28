<style src="./Timer.scss" module lang="scss"></style>
<script src="./Timer.js"></script>

<template>
  <div :class="[$style.timer]">
    <h3 :class="[$style.title, 'heading-03']">REMAINING TIME / TOTAL DURATION</h3>
    <p :class="['copy-01']">{{hours}}:{{minutes}}:{{seconds}} / {{experimentTime.hours()}}:{{experimentTime.minutes()}}:{{experimentTime.seconds()}}</p>
  </div>
</template>
