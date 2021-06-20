<style src="./AnalyticsPage.scss" module lang="scss"></style>
<script src="./AnalyticsPage.js"></script>

<template>
  <div :class="[$style.analyticsPage]" v-if="dataReady">
    <div :class="[$style.hero, '']">
      <h3 :class="['heading-02']">Select user:</h3>
      <select name="" id="" v-model="selectedUser" @change="getUserData">
        <option :value="user.id" v-for="(user, index) in users" :key="index">{{user.id}}</option>
      </select>
    </div>

    <div :class="[$style.graphs]" v-if="chartAvailable">
      <div>
        <apexchart width="450" type="line" :options="options" :series="series" ref="polical"></apexchart>
      </div>
      <div>
        <apexchart width="450" type="line" :options="optionsType" :series="seriesType" ref="type"></apexchart>
      </div>
      <div>
        <apexchart width="450" type="line" :options="optionsComplexity" :series="seriesComplexity" ref="complexity"></apexchart>
      </div>
    </div>
  </div>
</template>
