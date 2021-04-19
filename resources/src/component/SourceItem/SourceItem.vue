<style src="./SourceItem.scss" module lang="scss"></style>
<script src="./SourceItem.js"></script>

<template>
  <div :class="[$style.sourceItem]" @mouseover="handleMouseover" @mouseleave="handleMouseleave">
    <div :class="[$style.iconWrapper]" ref="icon">
<!--      <Icon name="book" :class="[$style.book]"/>-->
      <Icon name="audio" :class="[$style.audio]"/>
    </div>
    <p :class="[$style.title, 'copy-02']">What is climate change about?</p>

    <div :class="[$style.overlay, {[$style.isInverted]: isInverted}, {[$style.isRight]: isRight}]" ref="overlay">
      <h4 :class="[$style.overlayTitle, 'heading-03']">Adapting to climate change in Africa</h4>
      <p :class="[$style.overlayCopy, 'copy-01']">
        The intersection of present vulnerability and the prospect of climate change in Africa warrants proactive action now to reduce the risk of large-scale…
      </p>
      <a href="#" :class="[$style.overlayButton, 'primary-button']">
        View resource
      </a>
    </div>
  </div>
</template>
