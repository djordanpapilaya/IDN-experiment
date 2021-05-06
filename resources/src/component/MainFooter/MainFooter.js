import { AbstractTransitionComponent } from 'vue-transition-component';
import MainFooterTransitionController from './MainFooterTransitionController';
import { mapMutations } from 'vuex';
import {
  SET_GUIDE_WATCHED,
} from '../../store/module/app/app';

// @vue/component
export default {
  name: 'MainFooter',
  extends: AbstractTransitionComponent,
  data() {
    return {
      closeOpen: false,
      pauseOpen: false,
    };
  },
  methods: {
    ...mapMutations({
      setGuideWatched: SET_GUIDE_WATCHED,
    }),
    handleAllComponentsReady() {
      this.transitionController = new MainFooterTransitionController(this);
      this.isReady();
    },
    handlePopupPause() {
      this.pauseOpen = true;
      this.$parent.pauseTimer();
    },
    handlePopupFinish() {
      this.closeOpen = true;
      this.$parent.pauseTimer();
    },
    handleStop() {

    },
    handlePause() {
      window.location.href = '/logout';
    },
    handleCancel() {
      this.closeOpen = false;
      this.pauseOpen = false;
      this.$parent.playTimer();
    },
    handleHelp() {
      this.setGuideWatched(false);
    }
  },
};
