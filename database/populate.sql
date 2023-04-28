INSERT INTO USERS (IDUSER, NAME, USERNAME, PASSWORD, TYPE, BIO, EMAIL ,PROFILE_PICK) VALUES 
(1, 'John Smith', 'johnsmith', 'password123', 'AGENT', 'Customer support agent','ok@34.pt' ,'https://example.com/profiles/johnsmith.jpg'),
(2, 'Jane Doe', 'janedoe', 'password456', 'CLIENT', 'Customer','ok@ui.pt', 'https://example.com/profiles/janedoe.jpg'),
(3, 'David Lee', 'davidlee', 'password789', 'AGENT', 'Customer support agent','ok@up.pt', 'https://example.com/profiles/davidlee.jpg'),
(4, 'Sarah Johnson', 'sarahjohnson', 'passwordabc', 'CLIENT', 'Customer','ok@u1i.pt', 'https://example.com/profiles/sarahjohnson.jpg'),
(5, 'Alice Smith', 'alice', 'password', 'CLIENT', 'I love cats', 'ok@231231.pt','https://example.com/profile_pic'),
(6, 'Bob Johnson', 'bob', 'password', 'AGENT', 'I love dogs', 'ok@u2i.pt','https://example.com/profile_pic'),
(7, 'Charlie Brown', 'charlie', 'password', 'CLIENT', 'I love birds','o3@ui.pt', 'https://example.com/profile_pic'),
(8, 'David Lee', 'david', 'password', 'AGENT', 'I love fish', 'ok@1i.pt','https://example.com/profile_pic'),
(9, 'Emily White', 'emily', 'password', 'CLIENT', 'I love rabbits', 'o1@ui.pt','https://example.com/profile_pic'),
(10, 'Frank Green', 'frank', 'password', 'AGENT', 'I love hamsters','o4@ui.pt', 'https://example.com/profile_pic');

INSERT INTO DEPARTMENT_AGENT (IDAGENT, IDDEPARTMENT)
VALUES
(1, 1),
(3, 1),
(3, 2),
(6, 1),
(6, 3),
(8, 2),
(8, 4),
(8, 3),
(10, 2);

INSERT INTO STATUS (IDSTATUS, STATUS)
VALUES
  (1, 'Open'),
  (2, 'In Progress'), 
  (3, 'Pending'),
  (4, 'Closed');

INSERT INTO DEPARTMENTS (IDDEPARTMENT, DEPARTMENT_NAME, SINOPSE) VALUES 
(1, 'Sales','Just sell sell sell'),
(2, 'Customer Support', ' Need help i am here dont worry'),
(3, 'Marketing','Marketing i will take your money please !!'),
(4, 'Engineering', 'We are engenhering'),
(5, 'Human Resources', 'We are here because humans are bad people');

INSERT INTO TAGS (IDTAG, HASTAG_NAME) VALUES
(1, 'billing'),
(2, 'account'),
(3, 'product'),
(4, 'refund'),
(5, 'technical'),
(6, 'installation');

INSERT INTO FAQS (IDFAQ, QUESTION, ANSWER)
VALUES
  (1, 'What is the status of my order?', 'Your order is currently being processed and will be shipped within 3-5 business days.'),
  (2, 'How do I track my package?', 'You can track your package by entering the tracking number on our website.'),
  (3, 'What is your return policy?', 'We accept returns within 30 days of purchase. Please contact customer service to initiate a return.');

INSERT INTO TICKETS (IDTICKET, PUBLISHED_TIME, CONTENT, IDSTATUS, IDCLIENT, IDAGENT, IDDEPARTMENT)
VALUES
(1, 1642333800, 'I have a problem with my account', 1, 2, 1, 1),
(2, 1642381200, 'My order was not delivered', 2, 4, 3, 2),
(3, 1642406000, 'I need help with setting up my device', 1, 5, 6, 3),
(4, 1642456800, 'I want to cancel my subscription', 1, 7, 8, 4),
(5, 1642496400, 'I have a question about my billing', 3, 9, 10, 2);

INSERT INTO TAG_TICKET (IDTICKET, IDTAG) VALUES
(1, 2),
(2, 3),
(3, 6),
(4, 4),
(5, 1),
(5, 2);

INSERT INTO MESSAGES (IDMESSAGE, PUBLISHED_TIME, CONTENT, IDUSER, IDTICKET) VALUES 
(1, 1642333900, 'Hi there! How can I help you with your account issue?', 1, 1),
(2, 1642335000, 'I am having trouble logging in.', 2, 1),
(3, 1642336200, 'Okay, let me take a look at your account.', 1, 1),
(4, 1642337400, 'Thank you!', 2, 1),
(5, 1642381800, 'Hello! I apologize for the inconvenience. Can you please provide me with your order number?', 3, 2),
(6, 1642383000, 'My order number is #123456', 4, 2),
(7, 1642384200, 'Thank you! I am looking into this now.', 3, 2),
(8, 1642385400, 'Great, thank you!', 4, 2),
(9, 1642406200, 'Hello! Can you please provide me with the make and model of your device?', 6, 3),
(10, 1642407400, 'I have a Samsung Galaxy S21', 5, 3),
(11, 1642408600, 'Thank you! Let me look into this for you.', 6, 3),
(12, 1642409800, 'Thanks, I appreciate it!', 5, 3),
(13, 1642457100, 'Hello! I can assist you with cancelling your subscription. Can you please provide me with your account email?', 8, 4),
(14, 1642458300, 'My email is sarahjohnson@example.com', 7, 4),
(15, 1642459500, 'Thank you! Let me go ahead and process the cancellation for you.', 8, 4),
(16, 1642460700, 'Great, thank you!', 7, 4),
(17, 1642497000, 'Hello! I can assist you with your billing inquiry. Can you please provide me with your account email?', 10, 5),
(18, 1642498200, 'My email is emilywhite@example.com', 9, 5),
(19, 1642499400, 'Thank you! Let me look into this for you.', 10, 5),
(20, 1642500600, 'Thank you, I appreciate it!', 9, 5);