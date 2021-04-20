<style src="./VideoPlayer.scss" module lang="scss"></style>
<script src="./VideoPlayer.js"></script>

<template>
  <div :class="[$style.videoPlayer]">
    <div :class="$style.playerContainer">
      <vue-core-video-player @play="play" @pause="pause" src="https://www.w3schools.com/html/mov_bbb.mp4"></vue-core-video-player>
    </div>
  </div>
</template>
