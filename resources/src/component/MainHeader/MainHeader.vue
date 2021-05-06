<style src="./MainHeader.scss" module lang="scss"></style>
<script src="./MainHeader.js"></script>

<template>
  <div :class="[$style.mainHeader, 'wrapper']">
    <div :class="[$style.header, 'content-wrapper']">
      <div :class="[$style.logoWrapper]">
        <a href="">
          <img src="../../asset/image/uva-logo.png" alt="University of Amsterdam" :class="$style.logo">
        </a>
        <h1 :class="[$style.title, 'heading-03']">
          Experiment - Interactive Digital Narratives
        </h1>
      </div>
      <div :class="[$style.timer]">
        <timer ref="timer" />
      </div>
    </div>
  </div>
</template>
