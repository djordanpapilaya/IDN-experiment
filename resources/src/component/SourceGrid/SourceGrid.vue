<style src="./SourceGrid.scss" module lang="scss"></style>
<script src="./SourceGrid.js"></script>

<template>
  <div :class="['wrapper']">
    <div :class="[$style.sourceGrid, 'content-wrapper']">
      <source-item v-for="(item, index) in resources" :class="$style.item" :key="index" :visited="item.watched" :type="item.type" :data="item" />
    </div>
  </div>
</template>
