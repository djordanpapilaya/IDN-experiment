<style src="./MainFooter.scss" module lang="scss"></style>
<script src="./MainFooter.js"></script>

<template>
  <div :class="[$style.mainFooter, 'wrapper']">
    <div :class="[$style.footer, 'content-wrapper']">
      <a :class="[$style.button, $style.buttonRed, 'button primary-button']" @click="handleHelp">
        HELP
      </a>
      <a :class="[$style.button, 'button primary-button']" @click="handlePopupPause">
        Pause experiment
      </a>
      <a :class="[$style.button, 'button secondary-button']" @click="handlePopupFinish">
        Continue to final survey
      </a>
    </div>


    <div :class="[$style.popup]" v-if="closeOpen">
      <div :class="[$style.popupInner]">
        <h3 :class="['heading-02', $style.title]">Are you sure, you want to stop the experiment?</h3>
        <p :class="['copy-01', $style.copy]">
          By stopping the experiment, your results will be saved and stored for further analysis. After stopping, continueing later the experiment is not possible.
        </p>
        <div :class="[$style.buttonWrapper]">
          <a :class="[$style.button, 'button primary-button']" @click="handleStop">
            Yes
          </a>
          <a :class="[$style.button, 'button secondary-button']" @click="handleCancel">
            No
          </a>
        </div>
      </div>
    </div>

    <div :class="[$style.popup]" v-if="pauseOpen">
      <div :class="[$style.popupInner]">
        <h3 :class="['heading-02', $style.title]">Are you sure, you want to pause the experiment?</h3>
        <p :class="['copy-01', $style.copy]">
          By pausing the experiment, you can later come back and continue with the experiment. After pausing, you will automatically logged out.        </p>
        <div :class="[$style.buttonWrapper]">
          <a :class="[$style.button, 'button primary-button']" @click="handlePause">
            Yes
          </a>
          <a :class="[$style.button, 'button secondary-button']" @click="handleCancel">
            No
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
