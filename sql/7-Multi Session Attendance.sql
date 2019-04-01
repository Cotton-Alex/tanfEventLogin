/* CHECK MULTIPLE SESSION ATTENDANCE */
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