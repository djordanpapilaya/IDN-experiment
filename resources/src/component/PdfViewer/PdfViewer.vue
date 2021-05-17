<style src="./PdfViewer.scss" module lang="scss"></style>
<script src="./PdfViewer.js"></script>

<template>
  <div :class="[$style.pdfViewer]">
    <vue-pdf-app :pdf="'https://idn-experiment.s3.eu-central-1.amazonaws.com/' + data.path" :config="config" @after-created="afterCreatedHandler" />
  </div>
</template>
