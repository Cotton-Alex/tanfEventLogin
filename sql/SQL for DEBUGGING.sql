/*============================================================================*/
/*===   Clients    ===========================================================*/
/*============================================================================*/


SELECT H.[HouseholdID]
, S.[PersonID]
, P.[FirstName]
, P.[LastName]
, S.[SSN]
FROM [beta_torresmartinez].[PersonModule].[Person] P
JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
ON P.[PersonID] = S.[PersonID]
JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
ON P.[PersonID] = H.[PersonID]
ORDER BY [LastName], [SSN]


/*============================================================================*/
/*===    MultipleSessionEvents    ============================================*/
/*============================================================================*/

INSERT INTO [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession] (TANFMultipleSessionEventID, StartDate) 
VALUES (11, GETDATE());


SELECT TOP 1000 [MultipleSessionEventSessionID]
      ,[TANFMultipleSessionEventID]
      ,[StartDate]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession]
  ORDER BY [MultipleSessionEventSessionID] DESC


SELECT TOP 1000 M.[TANFMultipleSessionEventID]
    ,M.[EventName]
    ,S.[MultipleSessionEventSessionID]
    ,S.[StartDate]
    ,A.[PersonID]
    ,P.[FirstName]
    ,P.[LastName]
    ,A.[Attended]
    FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[TANFMultipleSessionEvent] M
    JOIN [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession] S
    ON M.[TANFMultipleSessionEventID] = S.[TANFMultipleSessionEventID]
    JOIN [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee] A
    ON S.[MultipleSessionEventSessionID] = A.[MultipleSessionEventSessionID]
    JOIN [beta_torresmartinez].[PersonModule].[Person] P
    ON A.[PersonID] = P.[PersonID]
    ORDER BY [MultipleSessionEventSessionID] DESC


/*============================================================================*/
/*===    OneTimeEvents    ====================================================*/
/*============================================================================*/


INSERT INTO [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement] (EventName, EventDate) 
VALUES ('INSERT NEW EVENT NAME', GETDATE());


SELECT TOP 1000 R.[OneTimeEventRegistrantID]
      ,R.[TANFOneTimeEventManagementID]
      ,N.[EventName]
      ,N.[EventDate]
      ,R.[RegistrantID]
      ,P.[FirstName]
      ,P.[LastName]
      ,R.[Attended]
  FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] R
  JOIN [beta_torresmartinez].[PersonModule].[Person] P
  ON R.[RegistrantID] = P.[PersonID]
  JOIN [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement] N
  ON R.[TANFOneTimeEventManagementID] = N.[TANFOneTimeEventManagementID]
  ORDER BY [OneTimeEventRegistrantID] DESC