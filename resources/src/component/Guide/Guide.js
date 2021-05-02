import { AbstractTransitionComponent } from 'vue-transition-component';
import GuideTransitionController from './GuideTransitionController';
import { mapMutations, mapState } from 'vuex';
import {  } from '../../store/module/app/app';
import { SET_GUIDE_WATCHED } from '../../store/module/app/app';

// @vue/component
export default {
  name: 'Guide',
  extends: AbstractTransitionComponent,
  computed: {
    ...mapState({
      userData: (state) => state.app.userData,
    }),
  },
  data() {
    return {
      currentStep: 1,
    };
  },
  methods: {
    ...mapMutations({
      setGuideWatched: SET_GUIDE_WATCHED,
    }),
    handleAllComponentsReady() {
      this.transitionController = new GuideTransitionController(this);
      this.isReady();
    },
    step2() {
      this.currentStep = 2;
    },
    step3() {
      this.currentStep = 3;
    },
    step4() {
      this.currentStep = 4;
    },
    close() {
      this.currentStep = 1;
      this.setGuideWatched(true);
    }
  },
};
