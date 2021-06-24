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
      <div :class="$style.graphWrapper">
        <apexchart width="450" type="line" :options="options" :series="series" ref="polical"></apexchart>
        <br><br>
        <p :class="'copy-04'">RELATIVE VALUES</p>
        <p :class="'copy-04'">Conservative: {{(user.all.stats.political_conservative / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Middle: {{(user.all.stats.political_center / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Progressive: {{(user.all.stats.political_progressive / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Start point: {{user.all.watched[0].political}}</p>
        <p :class="'copy-04'">End point: {{user.all.watched[user.all.stats.numb_of_sources -1].political}}</p>

      </div>
      <div :class="$style.graphWrapper">
        <apexchart width="450" type="line" :options="optionsType" :series="seriesType" ref="type"></apexchart>
        <br><br>
        <p :class="'copy-04'">RELATIVE VALUES</p>
        <p :class="'copy-04'">Video: {{(user.all.stats.type_video / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Audio: {{(user.all.stats.type_audio / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Text: {{(user.all.stats.type_text / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Start point: {{user.all.watched[0].type}}</p>
        <p :class="'copy-04'">End point: {{user.all.watched[user.all.stats.numb_of_sources -1].type}}</p>
      </div>
      <div :class="$style.graphWrapper">
        <apexchart width="450" type="line" :options="optionsComplexity" :series="seriesComplexity" ref="complexity"></apexchart>
        <br><br>
        <p :class="'copy-04'">RELATIVE VALUES</p>
        <p :class="'copy-04'">Simple: {{(user.all.stats.content_simple / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Medium: {{(user.all.stats.content_medium / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Complex: {{(user.all.stats.content_complex / user.all.stats.numb_of_sources).toFixed(3)}}</p>
        <p :class="'copy-04'">Start point: {{user.all.watched[0].content}}</p>
        <p :class="'copy-04'">End point: {{user.all.watched[user.all.stats.numb_of_sources -1].content}}</p>
      </div>
    </div>
  </div>
</template>
