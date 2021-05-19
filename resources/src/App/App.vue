<style src="./App.scss" module lang="scss"></style>
<script src="./App.js"></script>

<template>
  <div :class="[$style.app]" v-if="resourcesLoaded">
    <main-header ref="header" />
    <transition @leave="onLeave">
      <router-view />
    </transition>
    <guide v-if="!guideWatched" />
    <main-footer v-if="hasFooter" />
    <inactive-window @cancel="handleInactiveCancel" v-if="inactiveWindow" />
  </div>
</template>
