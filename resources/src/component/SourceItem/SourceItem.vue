<style src="./SourceItem.scss" module lang="scss"></style>
<script src="./SourceItem.js"></script>

<template>
  <div :class="[$style.sourceItem, {[$style.hasVisited]: data.watched}]" @mouseover="handleMouseover" @mouseleave="handleMouseleave">
    <router-link :to="'resource/'+data.uuid" :class="[$style.iconWrapper, 'js-icon']" ref="icon">
      <Icon name="book" :class="[$style.book]" v-if="data.type == 'text'"/>
      <Icon name="audio" :class="[$style.audio]" v-if="data.type == 'audio'" />
      <Icon name="play-circle" :class="[$style.playCircle]" v-if="data.type == 'video'" />
      <Icon name="check-circle" :class="[$style.visited]"/>
    </router-link>
    <p :class="[$style.title, 'copy-02']">{{data.short}}</p>

    <div :class="['js-overlay', $style.overlay, {[$style.isInverted]: isInverted}, {[$style.isRight]: isRight}]" ref="overlay">
      <div v-if="data.watched" :class="[$style.viewed, 'heading-04']">
        Viewed
      </div>
      <h4 :class="[$style.overlayTitle, 'heading-03']">{{data.title}}</h4>
      <p :class="[$style.overlayCopy, 'copy-01']">
        {{data.copy}}
      </p>
      <router-link :to="'resource/'+data.uuid" :class="[$style.overlayButton, 'primary-button']" v-if="data.type == 'text'">
        View document
      </router-link>
      <router-link :to="'resource/'+data.uuid" :class="[$style.overlayButton, 'primary-button']" v-if="data.type == 'audio'">
        Listen audio
      </router-link>
      <router-link :to="'resource/'+data.uuid" :class="[$style.overlayButton, 'primary-button']" v-if="data.type == 'video'">
        Watch video
      </router-link>
    </div>
  </div>
</template>
