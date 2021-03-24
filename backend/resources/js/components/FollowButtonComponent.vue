<template>
  <div>
    <button v-if="!follow" type="button" class="btn btn-white" @click="following(userId)">フォローする</button>
    <button v-if="follow" type="button" class="btn btn-blue" @click="unfollowing(userId)">フォローしています</button>
  </div>
</template>

<script>
export default {
  props: ["userId", "followCheck"],
  data() {
    return {
      follow: false
    };
  },
  created() {
    this.follow = this.followCheck
  },
  methods: {
    following(userId) {
      let url = `/user/${userId}/follow`;

      axios
        .post(url)
        .then(response => {
          this.follow = true
        })
        .catch(error => {
          alert(error);
        });
    },
    unfollowing(userId) {
      let url = `/user/${userId}/unfollow`;

      axios
        .post(url)
        .then(response => {
          this.follow = false
        })
        .catch(error => {
          alert(error);
        });
    }
  }
};
</script>

<style>
.btn-white {
  background-color: #fff;
}

</style>