<style src="./MainFooter.scss" module lang="scss"></style>
<script src="./MainFooter.js"></script>

<template>
  <div :class="[$style.mainFooter, 'wrapper']">
    <div :class="[$style.footer, 'content-wrapper']">
      <a href="" :class="[$style.button, 'button primary-button']">
        Pause experiment
      </a>
      <a href="" :class="[$style.button, 'button secondary-button']">
        Continue to final survey
      </a>
    </div>
  </div>
</template>
