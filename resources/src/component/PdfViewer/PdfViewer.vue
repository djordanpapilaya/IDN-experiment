<style src="./PdfViewer.scss" module lang="scss"></style>
<script src="./PdfViewer.js"></script>

<template>
  <div :class="[$style.pdfViewer]">
    <vue-pdf-app :pdf="data.path" :config="config" @after-created="afterCreatedHandler" />
  </div>
</template>
