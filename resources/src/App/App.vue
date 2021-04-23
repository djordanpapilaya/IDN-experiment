<style src="./App.scss" module lang="scss"></style>
<script src="./App.js"></script>

<template>
  <div :class="[$style.app]" v-if="resourcesLoaded">
    <main-header />
    <transition @leave="onLeave">
      <router-view />
    </transition>
    <main-footer />
  </div>
</template>
