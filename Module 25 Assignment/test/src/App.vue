<script setup>
  import TaskList from "./components/TaskList.vue";
  import { ref,reactive } from 'vue';
  const button = ref(true);
  const input = ref('');
  const items = reactive([]);

  const addTask = ()=>{
     if (input.value.length > 0) {
        items.push({name:input.value,status:false});
       return input.value = '';
    } else {
      alert('empty');  // If input is empty
    }
  }

  // Method to handle item deletion
  const deleteItem = (index) => {
    
   items.splice(index, 1); // Remove item from the reactive array
  };
  
  // Method to handle status change
  const changeStatus = (index, newStatus) => {
    items[index].status = newStatus; // Update the status of the item
  };

</script>

<template>
  <div class="container">
    <div class="row ">
      <div class="col-12">
        <h1 class="text-primary text-center mt-4">Task Management App</h1>
       <div class="wrap mt-4">
          <div class="form_div mt-3" v-if="button">
           <div class="row justify-content-center align-items-center g-2">
            <div class="col-3">
               <input type="text" v-model="input" name="task" class="form-control" placeholder="Enter Task Name">
            </div>
            <div class="col-2">
              <button @click="addTask()" type="button" class="btn btn-primary">Add Task</button>
            </div>
           </div>
          </div>
       </div>
       <TaskList :items="items" @status-change="changeStatus" @delete-item="deleteItem"/>
      </div>
    </div>
  </div>
  
</template>

<style scoped>

</style>
