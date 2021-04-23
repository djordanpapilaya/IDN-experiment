<style src="./SourcePage.scss" module lang="scss"></style>
<script src="./SourcePage.js"></script>

<template>
  <div :class="[$style.sourcePage]" v-if="resourceLoaded">
    <source-header :data="data" />
    <audio-player :class="$style.audioPlayer" :data="data" v-if="data.type == 'audio'" />
    <video-player :class="$style.videoPlayer" :data="data" v-if="data.type == 'video'" />
    <pdf-viewer :class="$style.pdfViewer" :data="data" v-if="data.type == 'text'" />
  </div>
</template>
