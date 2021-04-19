<style src="./AudioPlayer.scss" module lang="scss"></style>
<script src="./AudioPlayer.js"></script>

<template>
  <div :class="[$style.audioPlayer]">
    <div :class="[$style.player]" ref="audioPlayer">
      <div :class="$style.loading" ref="loading">
        <div :class="$style.spinner"></div>
      </div>
      <div :class="$style.playPauseBtn" @click="togglePlay" ref="playpauseBtn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
          <path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" :class="$style.playPauseIcon" id="playPause" ref="playPause" />
        </svg>
      </div>

      <div :class="$style.controls">
        <span :class="$style.currentTime" ref="currentTime">0:00</span>
        <div :class="$style.slider" data-direction="horizontal" ref="slider">
          <div :class="$style.progress" ref="progress">
            <div :class="[$style.pin, 'pin']" id="progress-pin" data-method="rewind" ref="pin"></div>
          </div>
        </div>
        <span :class="$style.totalTime" ref="totalTime">0:00</span>
      </div>

      <audio crossorigin ref="player" preload="auto">
        <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/355309/Swing_Jazz_Drum.mp3" type="audio/mpeg">
      </audio>
    </div>
  </div>
</template>
