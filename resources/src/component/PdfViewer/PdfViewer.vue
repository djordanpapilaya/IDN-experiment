<style src="./PdfViewer.scss" module lang="scss"></style>
<script src="./PdfViewer.js"></script>

<template>
  <div :class="[$style.pdfViewer]">
    <vue-pdf-app pdf="../../static/examples.pdf" :config="config" @after-created="afterCreatedHandler" />
  </div>
</template>
