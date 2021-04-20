<style src="./SourcePage.scss" module lang="scss"></style>
<script src="./SourcePage.js"></script>

<template>
  <div :class="[$style.sourcePage]">
    <source-header />
    <audio-player :class="$style.audioPlayer" />
  </div>
</template>
