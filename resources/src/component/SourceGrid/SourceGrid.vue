<style src="./SourceGrid.scss" module lang="scss"></style>
<script src="./SourceGrid.js"></script>

<template>
  <div :class="['wrapper']">
    <div :class="[$style.sourceGrid, 'content-wrapper']">
<!--      <source-item v-for="(item, index) in new Array(150)" :class="$style.item" :key="index" :visited="false" :type="'video'" />-->
      <source-item :class="$style.item" :key="index" :visited="false" :type="'video'" />
      <source-item :class="$style.item" :key="index" :visited="true" :type="'video'" />
      <source-item :class="$style.item" :key="index" :visited="false" :type="'audio'" />
      <source-item :class="$style.item" :key="index" :visited="true" :type="'audio'" />
      <source-item :class="$style.item" :key="index" :visited="false" :type="'text'" />
      <source-item :class="$style.item" :key="index" :visited="true" :type="'text'" />
    </div>
  </div>
</template>
