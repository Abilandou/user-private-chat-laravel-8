<template>

    <div class="container clearfix">
        <div class="people-list" id="people-list">

            <div class="search">
                <input type="text" placeholder="search" />
                <i class="fa fa-search"></i>
            </div>
            <ul class="list list-unstyled">
                <li @click.prevent="selectUser(user.id)" class="clearfix" v-for="user in userList" :key="user.id">
                    <img src="#" alt="avatar" class="ml-3"  style="border-radius:50%; background-color: grey; border: 3px solid pink;"/>
                    <div class="about">
                        <div class="name" style="font-size: 12px; color:black;">{{ user.name }}</div>
                        <div class="status">
                        <i class="fa fa-circle online text-white"></i> online
                        </div>
                    </div>
                </li>
                
                
            </ul>
        </div>
        
        <div class="chat">
            
        
            <div class="chat-header clearfix">
                <img src="#" alt="avatar" style="border-radius:50%; background-color: grey; border: 3px solid pink;"/>
                
                <div class="chat-about">
                <div class="chat-with" v-if="userMessage.user">{{ userMessage.user.name }}</div>
                <div class="chat-num-messages">already 1 902 messages</div>
                </div>
                <i class="fa fa-star"></i>
            </div> <!-- end chat-header -->
            
            <div class="chat-history" v-chat-scroll>
                <ul class="list-unstyled">
                <li class="clearfix" v-for="message in userMessage.messages" :key="message.id" >
                    <div class="message-data align-right">
                    <span class="message-data-time" >Time here</span> &nbsp; &nbsp;
                    <span class="message-data-name" >{{ message.user.name }} </span> <i class="fa fa-circle me"></i>
                    
                    </div>
                    <!-- <div class="message other-message float-right"> -->
                    <div :class="`message other-message float-right ${message.user.id==userMessage.user.id ? 'other-message' : 'my-message'}`">
                        {{message.message}}
                    </div>
                </li>
                </ul>
                
            </div> <!-- end chat-history -->

            <div class="chat-message clearfix">
                <textarea @keydown.enter="sendMessage" v-model="message" name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>
                        
                <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                <i class="fa fa-file-image-o"></i>
                
                <button  @click="sendMessage">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    mounted(){
        this.$store.dispatch('userList');
    },
    data(){
        return {
            message:'',
        }
    },

    computed: {
        userList() {
            return this.$store.getters.userList
        },

        userMessage(){
            return this.$store.getters.userMessage
        }
    },
  
   created(){

   },
   methods: {
       selectUser(userId){
           this.$store.dispatch('userMessage', userId);
       },

       sendMessage(e){
           e.preventDefault();
           if(this.message != '') {
               Axios.post('sendmessage', {
                   message: this.message,
                   user_id: this.userMessage.user.id
                })
                .then(response => {
                    // console.log(response.data);
                    this.selectUser(this.userMessage.user.id)
                })
                 this.message = '';
                // .catch(error => {
                //     console.log(`The Error: ${error.message} While posting message to database`);
                // })
               
           }
       }
   }
}
</script>

<style>
    .my-message {
        background: #86BB71;
    }

    .my-message:after {
        border-bottom-color:#86BB71;
        left: 10%;
    }
</style>