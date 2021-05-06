<style src="./InactiveWindow.scss" module lang="scss"></style>
<script src="./InactiveWindow.js"></script>

<template>
  <div :class="[$style.inactiveWindow]">
    <div :class="$style.inner">
      <h1 :class="$style.title">Are you still there?</h1>
      <p :class="['copy-01', $style.copy]">
        We paused the session, because no activity was detected. Do you want to continue or logout?
      </p>

      <div :class="[$style.buttonWrapper]">
        <a :class="[$style.button, 'button primary-button']" @click="handleLogout">
          Logout
        </a>
        <a :class="[$style.button, 'button secondary-button']" @click="handleCancel">
          Continue
        </a>
      </div>
    </div>
  </div>
</template>
