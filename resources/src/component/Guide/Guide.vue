<style src="./Guide.scss" module lang="scss"></style>
<script src="./Guide.js"></script>

<template>
  <div :class="[$style.guide]">
    <div :class="[$style.inner]">
      <div :class="[$style.slideOne]" ref="slideOne" v-if="currentStep === 1">
        <h2 :class="[$style.title, 'heading-01']">Welcome on the Interactive Digital Narratives experiment</h2>
        <p :class="[$style.copy, 'copy-04']">
          Hi {{userData.firstName}} {{userData.lastName}},
          <br><br>
          Thanks for joining the experiment of the UvA about Interactive Digital Narratives. You have now completed
          questionnaire one and can start with the practical part of the experiment. After you completed this part of
          the experiment, you can go back to the questionnaire in Quantics and complete the final part of the
          questionnaire.
          <br><br>
          This part of the experiment takes about 4 hours to complete. You can always stop the experiment but are
          encouraged to fulfil the whole 4 hours. You can pause any moment and come back later. Use your email and
          password to log back in. Please make sure to finish the entire experiment within two days.
          <br><br>
          Please now continue for more explanation.
        </p>
        <a :class="[$style.button, 'button primary-button']" @click="step2">
          Continue
        </a>
      </div>
      <div :class="[$style.slideTwo]" ref="slideTwo" v-if="currentStep === 2">
        <h2 :class="[$style.title, 'heading-01']">Visit the resources</h2>
        <p>
        <p :class="[$style.copy, 'copy-04']">
          Explore by clicking on an item and open the resource. The type of resources is indicated by the icon (text,
          video or audio). To view more information about the resource, place your mouse over the icon. A dialogue will
          give you more information about the resource.
          <br><br>
          When you have visited a resource, it displays a check icon to indicate that you already have visited the
          resource. You can revisit resources multiple times.
          <br><br>
          The resources are classified on conservative-progressive vertically and on complexity horizontally.
        </p>

        <img src="../../asset/image/guide-1.jpg" alt="" :class="[$style.image]">
        <a :class="[$style.button, 'button primary-button']" @click="step3">
          Continue
        </a>
      </div>
      <div :class="[$style.slideTree]" ref="slideTree" v-if="currentStep === 3">
        <h2 :class="[$style.title, 'heading-01']">Stop, pause & questions</h2>
        <p>
        <p :class="[$style.copy, 'copy-04']">
          If you would like to have a break from the experiment, please always use the pause button! When fully finished
          with the experiment, use the stop button and go to the questionnaire.
          <br><br>
          For any questions, email djordan.papilaya@student.uva.nl or for urgent matters, please call +31 6 812 659 04.
        </p>
        <a :class="[$style.button, 'button primary-button']" @click="step4">
          Continue
        </a>
      </div>
      <div :class="[$style.slideFour]" ref="slideFour" v-if="currentStep === 4">
        <h2 :class="[$style.title, 'heading-01']">Your task today</h2>
        <p>
        <p :class="[$style.copy, 'copy-04']">
          Try to gain more knowledge about the following topic:
          <br><br>
          <b>
            Climate change - What knowledge can you gain about this topic?
          </b>
          <br><br>
          We don't need an answer! Just explore and see what kind of information you can find or find interesting.
        </p>
        <a :class="[$style.button, 'button primary-button']" @click="close">
          Start the experiment
        </a>
      </div>
    </div>
  </div>
</template>
