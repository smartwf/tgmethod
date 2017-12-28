<?php
/**
 * @package     Telegram
 * @link        https://github.com/smartwf/tgmethod
 * @author      Smart <Hooshmandmrh@gmail.com>
 */
class tgmethod
{
    // Telegram Token
    protected $token=null;

    protected $ch;

    /**
     * initialize Class
     * @param string $api_token The token looks something like 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
     * @return bool
     */
    public function  __construct($api_token)
    {
        $this->token=$api_token;
        if (strlen($this->token)==45 && count(explode(':',$this->token))==2){
            $this->ch = curl_init();
            return true;
        }
        else
            return false;
    }

    /**
     * Destruct Class
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * Make Http Request
     * @param string $method  Mothod for calling
     * @param object $datas  Datas for Send to Telegram
     * @return object
     */
    private function make_http_request($method,$datas=null){
        $url = "https://api.telegram.org/bot".$this->token."/".$method;
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,($datas));
        curl_setopt($this->ch,CURLOPT_URL,$url);
        $res = curl_exec($this->ch);
        if(curl_error($this->ch)){
            $r=new \stdClass();
            $r->ok=false;
            $r->description=curl_error($this->ch);
            $r->errno=curl_errno($this->ch);
            return $r;
        }else{
            $res=json_decode($res);
            if ($res->ok){
                $res=$res->result;
                $res->ok=true;
            }

            return $res;
        }
    }





    /////////////////////////////////////////////////////////////////////




    /******************************************
     *                             *
     *       Method functions      *
     *                             *
     ******************************************/


    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook
     * @param string $url HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @param array $allowed_updates List the types of updates you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types
     * @param int $max_connections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100
     * @param file $certificate Upload your public key certificate so that the root certificate in use can be checked
     * @return object
     */
    public function setWebhook($url,$allowed_updates=null,$max_connections=null,$certificate=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates
     * @return object
     */
    public function deleteWebhook(){
        return $this->make_http_request(__FUNCTION__);
    }



    /**
     * Use this method to get current webhook status. Requires no parameters
     * @return object
     */
    public function getWebhookInfo(){
        return $this->make_http_request(__FUNCTION__);
    }



    /**
     * A simple method for testing your bot's auth token
     * @return object
     */
    public function getme(){
        return $this->make_http_request(__FUNCTION__);
    }



    /**
     * Use this method to send text messages
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $text Text of the message to be sent
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param string $parse_mode Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     * @param bool $disable_web_page_preview Disables link previews for links in this message
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendMessage($chat_id,$text,$reply_to_message_id=null,$parse_mode=null,$disable_web_page_preview=null,$reply_markup=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to forward messages of any kind
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function forwardMessage($chat_id,$from_chat_id,$message_id,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send photos
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $photo Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data
     * @param string $caption Photo caption (may also be used when resending photos by file_id), 0-200 characters
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendPhoto($chat_id,$photo,$caption=null,$reply_to_message_id=null,$reply_markup=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .mp3 format.
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $audio Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data.
     * @param string $caption Audio caption, 0-200 characters
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param string $title Track name
     * @param int $duration Duration of the audio in seconds
     * @param string $performer Performer
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendAudio($chat_id,$audio,$caption=null,$reply_to_message_id=null,$reply_markup=null,$title=null,$duration=null,$performer=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send general files
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $document File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param string $caption Document caption (may also be used when resending documents by file_id), 0-200 characters
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendDocument($chat_id,$document,$caption=null,$reply_to_message_id=null,$reply_markup=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document)
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $video Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data
     * @param string $caption Video caption (may also be used when resending videos by file_id), 0-200 characters
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param int $duration Duration of sent video in seconds
     * @param string $width	 Video width
     * @param string $height Video height
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendVideo($chat_id,$video,$caption=null,$reply_to_message_id=null,$reply_markup=null,$duration=null,$width=null,$height=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or Document)
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $voice Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
     * @param string $caption Voice message caption, 0-200 characters
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param int $duration Duration of the voice message in seconds
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendVoice($chat_id,$voice,$caption=null,$reply_to_message_id=null,$reply_markup=null,$duration=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video messages
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $video_note Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. -- Sending video notes by a URL is currently unsupported --
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param int $duration Duration of sent video in seconds
     * @param int $length Video width and height
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendVideoNote($chat_id,$video_note,$reply_to_message_id=null,$reply_markup=null,$duration=null,$length=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send a group of photos or videos as an album
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array $media A JSON-serialized array describing photos and videos to be sent, must include 2–10 items
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendMediaGroup($chat_id,$media,$reply_to_message_id=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send point on the map
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param int $live_period Period in seconds for which the location will be updated (see Live Locations, should be between 60 and 86400
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendLocation($chat_id,$latitude,$longitude,$reply_to_message_id=null,$reply_markup=null,$live_period=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation
     * @param int|string $chat_id 	Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return object
     */
    public function editMessageLiveLocation($chat_id=null,$message_id=null,$inline_message_id=null,$latitude,$longitude,$reply_markup=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to stop updating a live location message sent by the bot or via the bot (for inline bots) before live_period expires.
     * @param int|string $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return object
     */
    public function stopMessageLiveLocation($chat_id=null,$message_id=null,$inline_message_id=null,$reply_markup=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send information about a venue.
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param string $foursquare_id Foursquare identifier of the venue
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendVenue($chat_id,$latitude,$longitude,$title,$address,$reply_to_message_id=null,$reply_markup=null,$foursquare_id=null,$disable_notification=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send phone contacts
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string $last_name Contact's last name
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendContact($chat_id,$phone_number,$first_name,$last_name=null,$reply_to_message_id=null,$reply_markup=null,$disable_notification=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $action
     * @return object
     */
    public function sendChatAction($chat_id,$action)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get a list of profile pictures for a user
     * @param int $user_id Unique identifier of the target user
     * @param int $limit Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     * @param int $offset Sequential number of the first photo to be returned. By default, all photos are returned.
     * @return object
     */
    public function getUserProfilePhotos($user_id,$limit=null,$offset=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size
     * @param string $file_id File identifier to get info about
     * @return object
     */
    public function getFile($file_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }


    /**
     * Use this method to get File link
     * @param string|object $file_path The file path received from the getFile function
     * @return string
     */
    public function getFileLink($file_path)
    {
        if (is_object($file_path))
            $file_path=$file_path->file_path;
        return 'https://api.telegram.org/file/bot'.$this->token.'/'.$file_path;
    }



    /**
     * Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param int $until_date Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever
     * @return object
     */
    public function kickChatMember($chat_id,$user_id,$until_date=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @return object
     */
    public function unbanChatMember($chat_id,$user_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool $can_send_messages Pass True, if the user can send text messages, contacts, locations and venues
     * @param bool $can_send_media_messages Pass True, if the user can send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
     * @param bool $can_send_other_messages Pass True, if the user can send animations, games, stickers and use inline bots, implies can_send_media_messages
     * @param bool $can_add_web_page_previews Pass True, if the user may add web page previews to their messages, implies can_send_media_messages
     * @param int $until_date Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
     * @return object
     */
    public function restrictChatMember($chat_id,$user_id,$can_send_messages=null,$can_send_media_messages=null,$can_send_other_messages=null,$can_add_web_page_previews=null,$until_date=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool $can_post_messages Pass True, if the administrator can create channel posts, channels only
     * @param bool $can_edit_messages Pass True, if the administrator can edit messages of other users and can pin messages, channels only
     * @param bool $can_delete_messages Pass True, if the administrator can delete messages of other users
     * @param bool $can_change_info Pass True, if the administrator can change chat title, photo and other settings
     * @param bool $can_pin_messages Pass True, if the administrator can pin messages, supergroups only
     * @param bool $can_invite_users Pass True, if the administrator can invite new users to the chat
     * @param bool $can_promote_members Pass True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by him)
     * @param bool $can_restrict_members Pass True, if the administrator can restrict, ban or unban chat members
     * @return object
     */
    public function promoteChatMember($chat_id,$user_id,$can_post_messages=null,$can_edit_messages=null,$can_delete_messages=null,$can_change_info=null,$can_pin_messages=null,$can_invite_users=null,$can_promote_members=null,$can_restrict_members=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to export an invite link to a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function exportChatInviteLink($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param file $photo New chat photo, uploaded using multipart/form-data
     * @return object
     */
    public function setChatPhoto($chat_id,$photo)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function deleteChatPhoto($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $title New chat title, 1-255 characters
     * @return object
     */
    public function setChatTitle($chat_id,$title)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to change the description of a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $description New chat description, 0-255 characters
     * @return object
     */
    public function setChatDescription($chat_id,$description)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to pin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $message_id Identifier of a message to pin
     * @param bool $disable_notification Pass True, if it is not necessary to send a notification to all chat members about the new pinned message. Notifications are always disabled in channels
     * @return object
     */
    public function pinChatMessage($chat_id,$message_id,$disable_notification=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to unpin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function unpinChatMessage($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method for your bot to leave a group, supergroup or channel
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function leaveChat($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.)
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function getChat($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get a list of administrators in a chat
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function getChatAdministrators($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get the number of members in a chat
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function getChatMembersCount($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get information about a member of a chat
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @return object
     */
    public function getChatMember($chat_id,$user_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $sticker_set_name Name of the sticker set to be set as the group sticker set
     * @return object
     */
    public function setChatStickerSet($chat_id,$sticker_set_name)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return object
     */
    public function deleteChatStickerSet($chat_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send answers to callback queries sent from inline keyboards
     * @param string $callback_query_id Unique identifier for the query to be answered
     * @param string $text Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
     * @param bool $show_alert If true, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
     * @param string $url URL that will be opened by the user's client.
     * @param int $cache_time The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
     * @return object
     */
    public function answerCallbackQuery($callback_query_id,$text=null,$show_alert=null,$url=null,$cache_time=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send answers to an inline query
     * @param string $inline_query_id Unique identifier for the answered query
     * @param json $results A JSON-serialized array of results for the inline query
     * @param int $cache_time The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
     * @param bool $is_personal Pass True, if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query
     * @param string $next_offset Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don‘t support pagination. Offset length can’t exceed 64 bytes.
     * @param string $switch_pm_text If passed, clients will display a button with specified text that switches the user to a private chat with the bot and sends the bot a start message with the parameter switch_pm_parameter
     * @param string $switch_pm_parameter Deep-linking parameter for the /start message sent to the bot when user presses the switch button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.
     * @return object
     */
    public function answerInlineQuery($inline_query_id,$results,$cache_time=null,$is_personal=null,$next_offset=null,$switch_pm_text=null,$switch_pm_parameter=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to edit text and game messages sent by the bot or via the bot (for inline bots)
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string $text New text of the message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param string $parse_mode Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     * @param bool $disable_web_page_preview Disables link previews for links in this message
     * @return object
     */
    public function editMessageText($chat_id,$message_id,$text,$inline_message_id=null,$reply_markup=null,$parse_mode=null,$disable_web_page_preview=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to edit captions of messages sent by the bot or via the bot (for inline bots)
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string $caption New caption of the message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return object
     */
    public function editMessageCaption($chat_id,$message_id,$caption,$inline_message_id=null,$reply_markup=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to edit only the reply markup of messages sent by the bot or via the bot (for inline bots)
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param string $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @return object
     */
    public function editMessageReplyMarkup($chat_id,$message_id,$reply_markup,$inline_message_id=null)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to delete a message
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of the message to delete
     * @return object
     */
    public function deleteMessage($chat_id,$message_id)
    {
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to send .webp stickers
     * @param int|string $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $sticker Sticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .webp file from the Internet, or upload a new one using multipart/form-data
     * @param int $reply_to_message_id If the message is a reply, ID of the original message
     * @param json $reply_markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @param bool $disable_notification Sends the message silently. Users will receive a notification with no sound.
     * @return object
     */
    public function sendSticker($chat_id,$sticker,$reply_to_message_id=null,$reply_markup=null,$disable_notification=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to get a sticker set
     * @param string $name Name of the sticker set
     * @return object
     */
    public function getStickerSet($name){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times)
     * @param int $user_id User identifier of sticker file owner
     * @param file $png_sticker Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px
     * @return object
     */
    public function uploadStickerFile($user_id,$png_sticker){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to create new sticker set owned by a user. The bot will be able to edit the created sticker set
     * @param int $user_id User identifier of sticker file owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals)
     * @param string $title Sticker set title, 1-64 characters
     * @param file $png_sticker Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param bool $contains_masks Pass True, if a set of mask stickers should be created
     * @param json $mask_position A JSON-serialized object for position where the mask should be placed on faces
     * @return object
     */
    public function createNewStickerSet($user_id,$name,$title,$png_sticker,$emojis,$contains_masks=null,$mask_position=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to add a new sticker to a set created by the bot
     * @param int $user_id User identifier of sticker file owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals)
     * @param file $png_sticker Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param json $mask_position A JSON-serialized object for position where the mask should be placed on faces
     * @return object
     */
    public function addStickerToSet($user_id,$name,$png_sticker,$emojis,$mask_position=null){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to move a sticker in a set created by the bot to a specific position
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     * @return object
     */
    public function setStickerPositionInSet($sticker,$position){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }



    /**
     * Use this method to delete a sticker from a set created by the bot
     * @param string $sticker File identifier of the sticker
     * @return object
     */
    public function deleteStickerFromSet($sticker){
        return $this->make_http_request(__FUNCTION__,(object) get_defined_vars());
    }


}