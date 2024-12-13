<script setup>
    import { defineProps, defineEmits } from 'vue';
    // Define the items prop
    const props = defineProps({
        items: {
            type: Array,
            required: true,
        }
    });
    // Define an event to emit when an item is deleted
    const emit = defineEmits();

    // Method to delete an item
    const itemDelete = (index) => {
        // Emit event to delete the item at the given index
        emit('delete-item', index);
    };

    // Method to change the status of an item
    const statusChange = (index, currentStatus) => {
        const newStatus = !currentStatus; // Toggle the status (false -> true or true -> false)
        emit('status-change', index, newStatus); // Emit the updated status to the parent
    };

</script>
<template>
    <div class="task_items mt-3 m-auto">
       <div class="row pt-2 justify-content-center" v-for="(item,i) in props.items" :key="i">
            <div class="col-5">
                <div class="card" :class="(item.status) ?'bg-success':''">
                    <div class="card-body d-flex align-items-center">
                        <span :class="(item.status) ?'text-white':''">{{item.name}}</span>
                        <div class="ms-auto">
                            <button type="button" @click="statusChange(i,item.status)" :class="(item.status) ? 'bg-info text-white':'bg-success text-white'" class="status btn">{{ (item.status == false) ?'Complated':'Undo' }}</button>
                            <button type="button" @click="itemDelete(i)" class="status ms-1 btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>   
       </div>
    </div>
</template>