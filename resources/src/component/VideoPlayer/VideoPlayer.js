import { AbstractTransitionComponent } from 'vue-transition-component';
import VideoPlayerTransitionController from './VideoPlayerTransitionController';

// @vue/component
export default {
  name: 'VideoPlayer',
  extends: AbstractTransitionComponent,
  data(){
    return {
      playTime: 0,
      pauseTime: 0,
    };
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new VideoPlayerTransitionController(this);
      this.isReady();
    },
    play(e) {
      const time = e.target.currentTime;
      console.log('PLAY', time);
      this.playTime = time;
    },
    pause(e) {
      const time = e.target.currentTime;
      console.log('PAUSE', time);
      this.pauseTime = time;
      console.log('TOTAL_TIME', this.pauseTime - this.playTime);
    }
  },
};
