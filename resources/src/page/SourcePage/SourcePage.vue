<style src="./SourcePage.scss" module lang="scss"></style>
<script src="./SourcePage.js"></script>

<template>
  <div :class="[$style.sourcePage]">
    <source-header />
<!--    <audio-player :class="$style.audioPlayer" />-->
<!--    <video-player :class="$style.videoPlayer" />-->
    <pdf-viewer :class="$style.pdfViewer" />
  </div>
</template>
