<template>
  <button type="button" class="btn btn-primary" @click="submit()">フォローする</button>
</template>

<script>
export default {
  methods: {
    submit() {
      let url = `/friend_home/following`

      axios.post(url)
      .then(response => {

      })
      .catch(error => {
        alert(error)
      });
    }
  }
}
</script>

<style>

</style>