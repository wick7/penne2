<template>
  <div>
<div  class="container main">
  <form action="#" @submit.prevent="addIt()">
    <div class="row">
      <div class="col-md-12 col-xs-12">
                <label for="party" class="col-2 col-form-label">Party Name:</label>
                <input v-model="task.party" type="text" placeholder="Enter Party Name" style="text-transform: capitalize;" class="form-control" autofocus>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <label for="size"><strong>Party Size:</strong></label>
              <select class="form-control" v-model="task.size">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10+</option>
                  </select>
  </div>
</div>
      <div class="row">
        <div class="col-md-12">
          <label for="input" class="col-2 col-form-label">Phone Number: </label>
          <input class="form-control" type="tel"   v-model="task.phone"> <!-- Figure out how to deal with form control -->
          <!-- <input class="form-control input-medium bfh-phone" type="tel"  data-format="ddd-ddd-dddd" v-model="task.phone"> -->

        </div>
      </div>
    <div class="row marg">
      <div class="col-md-12">

            <span class="">
                  <button type="submit"  class="btn btn-primary">Add Info</button>
              </span>
          </div>

  </div>
  </form>
  <div class="row marg">
    <div class="col-md-12">
      <input class="form-control" type="search" v-model="search">
      <button type="submit"  class="btn btn-primary">Search</button>
    </div>
  </div>
  <div class="row marg">
    <div class="col-md-12">
      <transition-group name="list" tag="div">
               <span class="list-group-item item-list" v-for="(task, index) in searchIt" :key='task'> <!--Or use with computed prop v-for="task in searchIt" -->

                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true" @click="deleteIt(task.id)">&times;</span>
                  </button>
                <label for="input" class="col-form-label"><span>Name:</span> {{task.party}}</label>
                  <br><label for="input" class="col-form-label">Phone: {{task.phone}}</label>
                  <br><label for="input" class="col-form-label">Size: <span class="badge">{{task.size}}</span></label>
                  <br><label for="input" class="col-form-label">Since: <span class="badge">{{ task.created_at | moment("from", "now" ) }}</span></label>
              </span>
      </transition-group>
    </div>
  </div>


</div>
</div>

</template>

<script>
    export default {


        data() {
            return {
                search: '',
                list: [],
                task: {
                    party: '',
                    size: '',
                    phone: '',
                    created_at: 0,
                }
            };
          },
            created() {
            this.fetchIt();
      },

        methods: {

        //   searchIt() {
        //     axios.get('api/tasks').then((res) => {
        //       for (var i of res.data) {
        //         var players = i;
        //         console.log(players);
        //       }
        //     });
        // },

          fetchIt() {
                axios.get('api/tasks').then((res) => {
                    this.list = res.data;
                    console.log('Fired');

                });
            },

            addIt() {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        this.task.party = '';
                        this.task.size = '';
                        this.task.phone = '';
                        this.fetchIt();
                    })
                    .catch((err) => console.error(err));
            },

            deleteIt(id) {
                axios.delete('api/tasks/' + id)
                    .then((res) => {
                        this.fetchIt()
                    })
                    .catch((err) => console.error(err));
            },

        },
      computed: {
        searchIt: function() {
              return this.list.filter((task) => {
              return task.party.match(this.search);
            });
        }
      }
    }

</script>



<!-- // for (var i of res.data) {
//   var players = i;
//   console.log(i);
// });

// return this.task.filter((task) => {
// return task.party.match(this.temp);
// } -->

<!-- searchIt() {
  axios.get('api/tasks').then((res) => {
    for (var i of res.data) {
      var players = i;
      console.log(players);
    }
  });
}, -->



<!-- searchIt() {
  axios.get('api/tasks').then((res) => {
    for (var i of res.data) {
      if (i.party.toLowerCase() == this.search.toLowerCase()) {
        console.log('Match');
        this.search = '';
      } else {
        console.log('No Match. Or it didnt work');
        this.search = '';
      }
    }
  }); -->

<!-- searchIt() {
  axios.get('api/tasks').then((res) => {
    let len = res.data.length;
    for (var i of res.data) {
      console.log(i.party);
    }
  });
}, -->

<!-- if (res.task.party == this.search) {
  console.log('Match');
  this.search = '';
} else {
  console.log('No Match');
  this.search = '';
} -->



<!-- computed: {
  searchIt: function() {
    axios.get('api/tasks').then((res) => {
      this.list = res.data;
  });
      return this.task.filter((task) => {
      return tasker.party.match(this.temp);
   }); -->


<!-- searchIt: function() {
  return this.task.filter(function (tasks) {
    return tasks === data.temp
  });
}, -->

<!-- <transition-group name="list" tag="div">
        <span class="list-group-item item-list" v-for="(task, index) in list" :key="index">

            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true" @click="deleteIt(task.id)">&times;</span>
            </button>
          <label for="input" class="col-form-label"><span>Name:</span> {{task.party}}</label>
            <br><label for="input" class="col-form-label">Phone: {{task.phone}}</label>
            <br><label for="input" class="col-form-label">Size: <span class="badge">{{task.size}}</span></label>
            <br><label for="input" class="col-form-label">Since: <span class="badge">{{ task.created_at | moment("from", "now" ) }}</span></label>
        </span>
</transition-group> -->
