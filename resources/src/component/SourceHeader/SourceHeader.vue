<style src="./SourceHeader.scss" module lang="scss"></style>
<script src="./SourceHeader.js"></script>

<template>
  <div :class="[$style.sourceHeader]">
    <div :class="['wrapper']">
      <div :class="[$style.inner, 'content-wrapper']">
        <a href="" :class="[$style.button, 'primary-button']">
          <Icon name="arrow-left" :class="[$style.icon]"/>
          Return to sources
        </a>
        <h2 :class="[$style.title, 'heading-03']">What is climate change?</h2>
      </div>
    </div>
  </div>
</template>
