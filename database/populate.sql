INSERT INTO USERS ( NAME, USERNAME, PASSWORD, TYPE, BIO, EMAIL ,PROFILE_PICK) VALUES 
( 'John Smith', 'johnsmith', 'password123', 'AGENT', 'Customer support agent','ok@34.pt' ,'https://example.com/profiles/johnsmith.jpg'),
( 'Jane Doe', 'janedoe', 'password456', 'CLIENT', 'Customer','ok@ui.pt', 'https://example.com/profiles/janedoe.jpg'),
( 'David Lee', 'davidlee', 'password789', 'AGENT', 'Customer support agent','ok@up.pt', 'https://example.com/profiles/davidlee.jpg'),
( 'Sarah Johnson', 'sarahjohnson', 'passwordabc', 'CLIENT', 'Customer','ok@u1i.pt', 'https://example.com/profiles/sarahjohnson.jpg'),
( 'Alice Smith', 'alice', 'password', 'CLIENT', 'I love cats', 'ok@231231.pt','https://example.com/profile_pic'),
( 'Bob Johnson', 'bob', 'password', 'AGENT', 'I love dogs', 'ok@u2i.pt','https://example.com/profile_pic'),
( 'Charlie Brown', 'charlie', 'password', 'CLIENT', 'I love birds','o3@ui.pt', 'https://example.com/profile_pic'),
( 'David Lee', 'david', 'password', 'AGENT', 'I love fish', 'ok@1i.pt','https://example.com/profile_pic'),
( 'Emily White', 'emily', 'password', 'CLIENT', 'I love rabbits', 'o1@ui.pt','https://example.com/profile_pic'),
( 'Frank Green', 'frank', 'password', 'AGENT', 'I love hamsters','o4@ui.pt', 'https://example.com/profile_pic'),
( 'Tomas Sarmento', 'tomasarmento', '$2y$12$xQP8uMvRwSx90ppYikOELOGI0SIAg3HUJ8h493L8/vDSOv6Lu8N4m', 'ADMIN', 'I love hamsters','o4@ui.pt', 'https://example.com/profile_pic'),
('testing','teste@test.pt','teste','$2y$12$euvP3YpFXw.umQycCaS3g.CDTAkx4qHwx3BaBe90oiIYO6fGhsXIG','ADMIN','','');

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

INSERT INTO STATUS ( STATUS)
VALUES
  ('Open'),
  ( 'In Progress'), 
  ( 'Pending'),
  ( 'Closed');

INSERT INTO DEPARTMENTS ( DEPARTMENT_NAME, SINOPSE) VALUES 
('Sales','Just sell sell sell'),
('Customer Support', ' Need help i am here dont worry'),
('Marketing','Marketing i will take your money please !!'),
( 'Engineering', 'We are engenhering'),
( 'Human Resources', 'We are here because humans are bad people');

INSERT INTO TAGS ( HASTAG_NAME) VALUES
( 'billing'),
( 'account'),
( 'product'),
( 'refund'),
( 'technical'),
('installation');

INSERT INTO FAQS ( QUESTION, ANSWER)
VALUES
  ('What is the status of my order?', 'Your order is currently being processed and will be shipped within 3-5 business days.'),
  ( 'How do I track my package?', 'You can track your package by entering the tracking number on our website.'),
  ( 'What is your return policy?', 'We accept returns within 30 days of purchase. Please contact customer service to initiate a return.');

INSERT INTO TICKETS ( PUBLISHED_TIME, CONTENT, IDSTATUS, IDCLIENT, IDAGENT, IDDEPARTMENT)
VALUES
( 1642333800, 'I have a problem with my account', 1, 2, 1, 1),
( 1642381200, 'My order was not delivered', 2, 4, 3, 2),
( 1642406000, 'I need help with setting up my device', 1, 5, 6, 3),
( 1642456800, 'I want to cancel my subscription', 1, 7, 8, 4),
( 1642496400, 'I have a question about my billing', 3, 9, 10, 2);

INSERT INTO TAG_TICKET (IDTICKET, IDTAG) VALUES
(1, 2),
(2, 3),
(3, 6),
(4, 4),
(5, 1),
(5, 2);

INSERT INTO MESSAGES ( PUBLISHED_TIME, CONTENT, IDUSER, IDTICKET) VALUES 
( 1642333900, 'Hi there! How can I help you with your account issue?', 1, 1),
( 1642335000, 'I am having trouble logging in.', 2, 1),
( 1642336200, 'Okay, let me take a look at your account.', 1, 1),
( 1642337400, 'Thank you!', 2, 1),
( 1642381800, 'Hello! I apologize for the inconvenience. Can you please provide me with your order number?', 3, 2),
( 1642383000, 'My order number is #123456', 4, 2),
( 1642384200, 'Thank you! I am looking into this now.', 3, 2),
( 1642385400, 'Great, thank you!', 4, 2),
( 1642406200, 'Hello! Can you please provide me with the make and model of your device?', 6, 3),
( 1642407400, 'I have a Samsung Galaxy S21', 5, 3),
( 1642408600, 'Thank you! Let me look into this for you.', 6, 3),
( 1642409800, 'Thanks, I appreciate it!', 5, 3),
( 1642457100, 'Hello! I can assist you with cancelling your subscription. Can you please provide me with your account email?', 8, 4),
( 1642458300, 'My email is sarahjohnson@example.com', 7, 4),
( 1642459500, 'Thank you! Let me go ahead and process the cancellation for you.', 8, 4),
( 1642460700, 'Great, thank you!', 7, 4),
( 1642497000, 'Hello! I can assist you with your billing inquiry. Can you please provide me with your account email?', 10, 5),
( 1642498200, 'My email is emilywhite@example.com', 9, 5),
( 1642499400, 'Thank you! Let me look into this for you.', 10, 5),
( 1642500600, 'Thank you, I appreciate it!', 9, 5);