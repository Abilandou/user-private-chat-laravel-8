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
                        <div class="name" style="font-size: 12px; color:black;">
                            {{ user.name }}
                        </div>
                        <div class="status text-grey">
                            <div v-if="onlineUser(user.id) || online.id==user.id ">
                                <i class="fa fa-circle online text-success"></i>online
                            </div>
                            <div v-else>
                                <i class="fa fa-circle online text-grey"></i>offline
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="chat">

            <div class="chat-header clearfix ">
                <img src="#" alt="avatar" style="border-radius:50%; background-color: grey; border: 3px solid pink;"/>
                <div class="chat-about">
                    <div class="chat-with" v-if="userMessage.user">{{ userMessage.user.name }}</div>
                    <div class="chat-num-messages"> 
                        <small> last seen</small><br>
                        <small class="text-danger" v-if="typing">{{ typing }} typing...</small>
                    </div>
                </div>
                <div>
                    <div class="dropdown show">
                        <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a @click.prevent="deleteAllMessage" class="dropdown-item" href="#">Delete all</a>
                        </div>
                    </div>
                </div>
                <i class="fa fa-star"></i>
            </div> <!-- end chat-header -->
            
            <div class="chat-history" v-chat-scroll>
                <ul class="list-unstyled">
                <li class="clearfix d-flex-column" v-for="message in userMessage.messages" :key="message.id" >
                    <div class="message-data align-right">
                        <span class="message-data-time" >Time here</span> &nbsp; &nbsp;
                        <span class="message-data-name" >{{ message.user.name }} </span> <i class="fa fa-circle me"></i>
                    </div>
                    <div :class="`message d-flex-space float-right ${message.user.id==userMessage.user.id ? 'other-message' : 'my-message'}`">
                        <span>{{message.message}}</span>
                        <a @click.prevent="deleteSingleMessage(message.id)" href="#" class="text-success"><i class="fa fa-trash"></i> </a>
                    </div>
                </li>
                </ul>
                
            </div> <!-- end chat-history -->
                
                <div class="ml-5" style="margin-bottom: -2rem;">
                    <small class="text-danger" v-if="typing">{{ typing }} typing...</small>
                </div>
            <div class="chat-message clearfix">
                <textarea v-if="userMessage.user" @keydown="typingEvent(userMessage.user.id)" @keydown.enter="sendMessage" v-model="message" name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>
                <textarea v-else disabled name="message-to-send" id="message-to-send" placeholder ="Please select a user to start a chat" rows="3"></textarea>
                        
                <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                <i class="fa fa-file-image-o"></i>
                
                <button  @click="sendMessage">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import _ from 'lodash';

export default {
    mounted(){
        Echo.private(`chat.${authuser.id}`)
        .listen('MessageEvent', (e) => {
            this.selectUser(e.message.from);
        });
        this.$store.dispatch('userList');

        Echo.private('typingevent')
        .listenForWhisper('typing', (e) => {
            // if(e.user.id == this.userMessage.user.id && e.user.id == authuser.id ){
                this.typing = e.user.name;
            // }
            setTimeout(() => {
                this.typing = '';
            }, 3000);
        })

         Echo.join('liveuser')
        .here((users) =>{
            this.users = users
        })
         .joining((user) =>{
            this.online = user;
        })
         .leaving((user) =>{
            console.log(user.name+ " Went Offline")
        });
    },
    data(){
        return {
            message:'',
            typing:'',
            users:[],
            online:'',
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
                    //Reload user messages
                    this.selectUser(this.userMessage.user.id)
                })
                 this.message = '';
               
           }
       },

        deleteSingleMessage(messageId){
           Axios.get(`deletemessage/${messageId}`)
           .then(response => {
               //Reload user messages
               this.selectUser(this.userMessage.user.id)
               console.log(response.data);
           })
        },

        deleteAllMessage(){
            Axios.get(`deleteallmessage/${this.userMessage.user.id}`)
           .then(response => {
               this.selectUser(this.userMessage.user.id)
               console.log(response.data);
           })
        },

        typingEvent(userId){
            Echo.private('typingevent')
            .whisper('typing', {
                'user': authuser,
                'typing': this.message,
                'userId': userId
            });
        },

        onlineUser(userId){
            return _.find(this.users, {'id':userId});
        }
   }
}
</script>

<style>
    .my-message {
        background: #ff4089;
    }

    .my-message:after {
        border-bottom-color: #ff4089;
        left: 10%;
    }

    .other-message {
        background-color: rgb(231, 225, 225);
        color: black !important;
    }

    .other-message:after {
        border-bottom-color: rgb(231, 225, 225);
        left: 90%;
    }

    .d-flex-column {
        display: flex;
        flex-direction: column;
    }

    .d-flex-space {
        display: flex;
        justify-content: space-between;
    }

    .text-grey {
        color: grey;
    }
</style>