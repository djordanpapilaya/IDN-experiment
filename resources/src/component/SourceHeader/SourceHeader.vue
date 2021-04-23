<style src="./SourceHeader.scss" module lang="scss"></style>
<script src="./SourceHeader.js"></script>

<template>
  <div :class="[$style.sourceHeader]">
    <div :class="['wrapper']">
      <div :class="[$style.inner, 'content-wrapper']">
        <router-link to="/" :class="[$style.button, 'primary-button']">
          <Icon name="arrow-left" :class="[$style.icon]"/>
          Return to sources
        </router-link>
        <h2 :class="[$style.title, 'heading-03']">{{data.title}}</h2>
      </div>
    </div>
  </div>
</template>
