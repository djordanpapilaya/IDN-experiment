import { AbstractTransitionComponent } from 'vue-transition-component';
import AudioPlayerTransitionController from './AudioPlayerTransitionController';

// @vue/component
export default {
  name: 'AudioPlayer',
  extends: AbstractTransitionComponent,
  data() {
    return {
      player: null,
      playPause: null,
      playPauseBtn: null,
      currentTime: null,
      audioPlayer: null,
      loading: null,
      progress: null,
      slider: null,
      totalTime: null,
      speaker: null,
      currentlyDragged: null,
      draggableClasses: null,
    };
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new AudioPlayerTransitionController(this);
      this.isReady();
      this.player = this.$refs.player;
      this.playPause = this.$refs.playPause;
      this.audioPlayer = this.$refs.audioPlayer;
      this.playpauseBtn = this.$refs.playpauseBtn;
      this.loading = this.$refs.loading;
      this.totalTime = this.$refs.totalTime;
      this.progress = this.$refs.progress;
      this.currentTime = this.$refs.currentTime;
      this.draggableClasses = ['pin'];
      this.slider = this.$refs.slider;

      // this.sliders.forEach(slider => {
      let pin = this.slider.querySelector('.pin');
      this.slider.addEventListener('click', this.rewind);
      // });

      this.player.addEventListener('timeupdate', this.updateProgress);
      this.player.addEventListener('ended', this.ended);
      this.player.addEventListener('loadedmetadata', () => {
        this.totalTime.textContent = this.formatTime(this.player.duration);
      });
      if (this.player.readyState >= this.player.HAVE_FUTURE_DATA) {
        this.makePlay();
      } else {
        this.player.addEventListener('canplay', () => {
          this.makePlay();
        }, false);
      }

      window.addEventListener('mousedown', (event) => {
        if (!this.isDraggable(event.target)) {
          return false;
        }

        this.currentlyDragged = event.target;
        let handleMethod = this.currentlyDragged.dataset.method;

        window.addEventListener('mousemove', this.rewind, false);

        window.addEventListener('mouseup', () => {
          this.currentlyDragged = false;
          window.removeEventListener('mousemove', this.rewind, false);
        }, false);
      });

    },
    togglePlay() {
      if (this.player.paused) {
        this.playPause.attributes.d.value = 'M0 0h6v24H0zM12 0h6v24h-6z';
        this.player.play();
      } else {
        this.playPause.attributes.d.value = 'M18 12L0 24V0';
        this.player.pause();
      }
    },
    isDraggable(el) {
      let canDrag = false;
      let classes = Array.from(el.classList);

      this.draggableClasses.forEach(draggable => {
        if (classes.indexOf(draggable) !== -1) {
          canDrag = true;
        }
      });
      return canDrag;
    },
    inRange(event) {
      let rangeBox = this.getRangeBox(event);
      let rect = rangeBox.getBoundingClientRect();
      let direction = rangeBox.dataset.direction;
      if (direction === 'horizontal') {
        const min = rangeBox.offsetLeft;
        const max = min + rangeBox.offsetWidth;
        if (event.clientX < min || event.clientX > max) {
          return false;
        }
      } else {
        const min = rect.top;
        const max = min + rangeBox.offsetHeight;
        if (event.clientY < min || event.clientY > max) {
          return false;
        }
      }
      return true;
    },
    updateProgress() {
      const current = this.player.currentTime;
      const percent = (current / this.player.duration) * 100;
      this.progress.style.width = percent + '%';

      this.currentTime.textContent = this.formatTime(current);
    },
    makePlay() {
      this.playpauseBtn.style.display = 'block';
      this.loading.style.display = 'none';
    },
    ended() {
      this.playPause.attributes.d.value = 'M18 12L0 24V0';
      this.player.currentTime = 0;
    },
    getRangeBox(event) {
      let rangeBox = event.target;
      let el = this.currentlyDragged;
      if (event.type === 'click' && this.isDraggable(event.target)) {
        rangeBox = event.target.parentElement.parentElement;
      }
      if (event.type === 'mousemove') {
        rangeBox = el.parentElement.parentElement;
      }
      return rangeBox;
    },
    getCoefficient(event) {
      let slider = this.getRangeBox(event);
      let rect = slider.getBoundingClientRect();
      let K = 0;
      if (slider.dataset.direction === 'horizontal') {

        let offsetX = event.clientX - slider.offsetLeft;
        let width = slider.clientWidth;
        K = offsetX / width;

      } else if (slider.dataset.direction === 'vertical') {

        let height = slider.clientHeight;
        let offsetY = event.clientY - rect.top;
        K = 1 - offsetY / height;

      }
      return K;
    },
    rewind(event) {
      if (this.inRange(event)) {
        this.player.currentTime = this.player.duration * this.getCoefficient(event);
      }
    },
    formatTime(time) {
      const min = Math.floor(time / 60);
      const sec = Math.floor(time % 60);
      return min + ':' + ((sec < 10) ? ('0' + sec) : sec);
    },
    directionAware() {
      if (window.innerHeight < 250) {
        this.volumeControls.style.bottom = '-54px';
        this.volumeControls.style.left = '54px';
      } else if (this.audioPlayer.offsetTop < 154) {
        this.volumeControls.style.bottom = '-164px';
        this.volumeControls.style.left = '-3px';
      } else {
        this.volumeControls.style.bottom = '52px';
        this.volumeControls.style.left = '-3px';
      }
    }
  },
};
