function SendMessage() {
    var statusApproved = document.getElementById('product_approved').checked;
    var m_phone = document.getElementById('m_phone').value;
    var message = document.getElementById('message').value;

    if (!statusApproved) {
        alert('Message will only be sent if the appointment is approved.');
        return;
    }

    if (message.trim() != '') { // Avoid White Space
        var _data = {
            "receiver": m_phone,
            "message": message // Do not append watermark unless necessary
        };

        console.log('Data to send:', _data);

        writeToScreen('<div class="message">The message was sent.</div>');
        const phoneArray = m_phone.trim().split(",");

        try {
            var mydata = JSON.stringify(_data);
            var dataSize = new Blob([mydata]).size;
            console.log(mydata);
            websocket.send(mydata);
        } catch (error) {
            console.error('Error sending WebSocket message:', error);
        }

        document.getElementById('message').focus();
    }
}