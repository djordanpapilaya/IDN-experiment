<style src="./VideoPlayer.scss" module lang="scss"></style>
<script src="./VideoPlayer.js"></script>

<template>
  <div :class="[$style.videoPlayer]">
    <div :class="$style.playerContainer">
      <vue-core-video-player @play="play" @pause="pause" :src="'https://idn-experiment.s3.eu-central-1.amazonaws.com/' + data.path"></vue-core-video-player>
    </div>
  </div>
</template>
