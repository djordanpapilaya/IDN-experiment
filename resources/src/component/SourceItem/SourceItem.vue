<style src="./SourceItem.scss" module lang="scss"></style>
<script src="./SourceItem.js"></script>

<template>
  <div :class="[$style.sourceItem, {[$style.hasVisited]: visited}]" @mouseover="handleMouseover" @mouseleave="handleMouseleave">
    <div :class="[$style.iconWrapper]" ref="icon">
      <Icon name="book" :class="[$style.book]" v-if="type == 'text'"/>
      <Icon name="audio" :class="[$style.audio]" v-if="type == 'audio'" />
      <Icon name="play-circle" :class="[$style.playCircle]" v-if="type == 'video'" />
      <Icon name="check-circle" :class="[$style.visited]"/>
    </div>
    <p :class="[$style.title, 'copy-02']">What is climate change about?</p>

    <div :class="[$style.overlay, {[$style.isInverted]: isInverted}, {[$style.isRight]: isRight}]" ref="overlay">
      <div v-if="visited" :class="[$style.viewed, 'heading-04']">
        Viewed
      </div>
      <h4 :class="[$style.overlayTitle, 'heading-03']">Adapting to climate change in Africa</h4>
      <p :class="[$style.overlayCopy, 'copy-01']">
        The intersection of present vulnerability and the prospect of climate change in Africa warrants proactive action now to reduce the risk of large-scale…
      </p>
      <router-link :to="'/'" :class="[$style.overlayButton, 'primary-button']" v-if="type == 'text'">
        View document
      </router-link>
      <router-link :to="'/'" :class="[$style.overlayButton, 'primary-button']" v-if="type == 'audio'">
        Listen audio
      </router-link>
      <router-link :to="'/'" :class="[$style.overlayButton, 'primary-button']" v-if="type == 'video'">
        Watch video
      </router-link>
    </div>
  </div>
</template>
